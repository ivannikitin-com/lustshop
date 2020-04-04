import { isUndefined, pickBy } from 'lodash';

const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { withSelect } = wp.data;
const apiFetch = wp.apiFetch;
const { addQueryArgs } = wp.url;
const { InspectorControls } = wp.blockEditor;
const ServerSideRender = wp.serverSideRender;

const { PanelBody, QueryControls, RangeControl, ToggleControl, TextControl } = wp.components;

const CATEGORIES_LIST_QUERY = {
	per_page: -1,
};

class LustShopNews extends Component {
	constructor() {
		super( ...arguments );
		this.state = {
			categoriesList: [],
		};
	}

	componentDidMount() {
		this.isStillMounted = true;
		this.fetchRequest = apiFetch( {
			path: addQueryArgs( '/wp/v2/categories', CATEGORIES_LIST_QUERY ),
		} )
			.then( categoriesList => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList } );
				}
			} )
			.catch( () => {
				if ( this.isStillMounted ) {
					this.setState( { categoriesList: [] } );
				}
			} );
	}

	componentWillUnmount() {
		this.isStillMounted = false;
	}

	render() {
		const { attributes, setAttributes } = this.props;
		const { categoriesList } = this.state;
		const {
			displayPostContent,
			displayPostDate,
			order,
			orderBy,
			categories,
			excerptLength,
			showButton,
			textButton,
		} = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={ __( 'Post Content Settings' ) }>
					<TextControl
						label={ __( 'Text button', 'lustshop' ) }
						onChange={ value => setAttributes( { textButton: value } ) }
						value={ textButton }
					/>
					<ToggleControl
						label={ __( 'Post Content' ) }
						checked={ displayPostContent }
						onChange={ value => setAttributes( { displayPostContent: value } ) }
					/>
					{ displayPostContent && (
						<RangeControl
							label={ __( 'Max number of words in excerpt' ) }
							value={ excerptLength }
							onChange={ value => setAttributes( { excerptLength: value } ) }
							min={ 10 }
							max={ 100 }
						/>
					) }
				</PanelBody>

				<PanelBody title={ __( 'Post Meta Settings' ) }>
					<ToggleControl
						label={ __( 'Display post date' ) }
						checked={ displayPostDate }
						onChange={ value => setAttributes( { displayPostDate: value } ) }
					/>
					<ToggleControl
						label={ __( 'Show button', 'lustshop' ) }
						checked={ showButton }
						onChange={ value => setAttributes( { showButton: value } ) }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Sorting and Filtering' ) }>
					<QueryControls
						{ ...{ orderBy, order } }
						categoriesList={ categoriesList }
						selectedCategoryId={ categories }
						onOrderChange={ value => setAttributes( { order: value } ) }
						onOrderByChange={ value => setAttributes( { orderBy: value } ) }
						onCategoryChange={ value =>
							setAttributes( { categories: '' !== value ? value : undefined } )
						}
					/>
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{ inspectorControls }
				<ServerSideRender block="lustshop/blog" attributes={ { ...attributes } } />
			</Fragment>
		);
	}
}

export default withSelect( ( select, props ) => {
	const { postsToShow, order, orderBy, categories } = props.attributes;
	const { getEntityRecords } = select( 'core' );
	const latestPostsQuery = pickBy(
		{
			categories,
			order,
			orderby: orderBy,
			per_page: postsToShow,
			_embed: true,
		},
		value => ! isUndefined( value )
	);
	return {
		latestPosts: getEntityRecords( 'postType', 'post', latestPostsQuery ),
	};
} )( LustShopNews );
