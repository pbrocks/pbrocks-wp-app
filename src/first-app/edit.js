/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import './app-edit';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	const setButtonLabel = () => {
		if (select('core/editor').isSavingPost() || select('core/editor').isAutosavingPost()) {
			return;
		}

		if (!select('core/editor').isEditedPostSaveable()) {
			return;
		}

		const currentStatus = select('core/editor').getEditedPostAttribute('status');

		const statusLabel =
			currentStatus === 'ready_to_publish'
				? __('Save as Ready to Publish')
				: __('Save draft');

		const saveButton = document.getElementsByClassName('components-button editor-post-save-draft is-tertiary');

		if (saveButton && saveButton.length && statusLabel !== '') {
			saveButton[0].innerText = statusLabel;
		}
	};
	return (
		<p {...useBlockProps()}>
			{__(
				'First App Info – editor content will change (will not be a block)!',
				'pbrocks-wp-app'
			)}
		</p>
	);
}
