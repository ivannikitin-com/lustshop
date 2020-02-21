const { __ } = wp.i18n
const { Component, Fragment } = wp.element
const { InspectorControls } = wp.blockEditor
const apiFetch = wp.apiFetch
const { addQueryArgs } = wp.url
const { PanelBody, QueryControls, ToggleControl } = wp.components
const ServerSideRender = wp.serverSideRender

const CATEGORIES_LIST_QUERY = {
	per_page: -1,
}

class WooCategory extends Component {
	constructor() {
		super(...arguments)
		this.state = {
			categoriesList: [],
			name: '',
		}
	}

	componentDidMount() {
		this.isStillMounted = true
		this.fetchRequest = apiFetch({
			path: addQueryArgs('/wc/v3/products/categories', CATEGORIES_LIST_QUERY),
		})
			.then(categoriesList => {
				if (this.isStillMounted) {
					this.setState({ categoriesList })
				}
			})
			.catch(() => {
				if (this.isStillMounted) {
					this.setState({ categoriesList: [] })
				}
			})
	}

	componentWillUnmount() {
		this.isStillMounted = false
	}

	componentDidUpdate() {
		this.handleChangeNameCategory()
	}

	handleChangeNameCategory = () => {
		const { categoriesList, name } = this.state
		const {
			setAttributes,
			attributes: { categoryName },
		} = this.props

		if (!!categoriesList.length && name !== categoryName) {
			const selectCategory = this.findSelectCategory()

			if (selectCategory) {
				setAttributes({
					categoryName: selectCategory.name,
				})
			}
		}
	}

	findSelectCategory = () => {
		const { categoriesList } = this.state
		const {
			attributes: { categoryId },
		} = this.props
		return categoriesList.find(item => item.id === Number(categoryId))
	}

	render() {
		const { attributes, setAttributes } = this.props
		const { categoriesList } = this.state
		const { categoryId, exclusive } = attributes

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__('Settings')}>
					<QueryControls
						categoriesList={categoriesList}
						selectedCategoryId={categoryId}
						onCategoryChange={value => setAttributes({ categoryId: Number(value) })}
					/>
					<ToggleControl
						label={__('Exclusive', 'lustshop')}
						checked={exclusive}
						onChange={() => setAttributes({ exclusive: !exclusive })}
					/>
				</PanelBody>
			</InspectorControls>
		)

		return (
			<Fragment>
				{inspectorControls}{' '}
				<ServerSideRender block="lustshop/woo-category" attributes={{ ...attributes }} />
			</Fragment>
		)
	}
}

export default WooCategory
