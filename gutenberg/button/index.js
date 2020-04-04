import classnames from 'classnames'
import { Arrow } from '../components/Icons'

const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { Fragment } = wp.element
const { RichText, URLInput } = wp.editor
const { Dashicon, IconButton, SelectControl, PanelBody, ToggleControl } = wp.components
const { InspectorControls } = wp.blockEditor

registerBlockType('lustshop/button', {
	title: __('Button', 'lustshop'),
	category: 'lustshop',
	keywords: [__('lustshop'), __('Button', 'lustshop')],
	attributes: {
		text: {
			type: 'string',
		},
		link: {
			type: 'string',
		},
		type: {
			type: 'string',
			default: 'default',
		},
		showArrow: {
			type: 'boolean',
			default: false,
		},
	},
	edit: props => {
		const { className, setAttributes, attributes, isSelected } = props
		const { title, link, type, showArrow } = attributes

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__('Settings')}>
					<SelectControl
						label="Size"
						value={type}
						options={[
							{ label: __('Default', 'lustshop'), value: 'default' },
							{ label: __('Primary', 'lustshop'), value: 'primary' },
							{ label: __('Secondary', 'lustshop'), value: 'secondary' },
						]}
						onChange={value => {
							setAttributes({ type: value })
						}}
					/>
					<ToggleControl
						label={__('Show arrow', 'lustshop')}
						checked={showArrow}
						onChange={() => setAttributes({ showArrow: !showArrow })}
					/>
				</PanelBody>
			</InspectorControls>
		)

		return (
			<Fragment>
				{inspectorControls}
				<div className={classnames(className, `${className}--${type}`)}>
					<RichText
						tagName="span"
						value={title}
						formattingControls={['bold', 'italic']}
						onChange={value => setAttributes({ title: value })}
						placeholder={__('Heading...')}
					/>
					{showArrow && <Arrow />}
				</div>
				{isSelected && (
					<form
						className="block-library-button__inline-link"
						onSubmit={event => event.preventDefault()}
					>
						<Dashicon icon="admin-links" />
						<URLInput
							value={link}
							autoFocus={false}
							onChange={value => setAttributes({ link: value })}
						/>
						<IconButton icon="editor-break" label={__('Apply')} type="submit" />
					</form>
				)}
			</Fragment>
		)
	},
	save: props => {
		const { attributes } = props
		const { title, link, type, showArrow } = attributes

		return (
			<a className={classnames(`wp-block-lustshop-button--${type}`)} href={link}>
				{title}
				{showArrow && <Arrow />}
			</a>
		)
	},
})
