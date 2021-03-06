<?php

/**
 * Editable Literal Field. A literal field is just a blank slate where
 * you can add your own HTML / Images / Flash
 * 
 * @package userforms
 */

class EditableLiteralField extends EditableFormField {
	
	private static $singular_name = 'HTML Block';
	
	private static $plural_name = 'HTML Blocks';
	
	public function getFieldConfiguration() {
		$customSettings = unserialize($this->CustomSettings);	
		$content = (isset($customSettings['Content'])) ? $customSettings['Content'] : '';
		$textAreaField = new TextareaField(
			$this->getSettingName('Content'),
			"HTML",
			$content
		);
		$textAreaField->setRows(4);
		$textAreaField->setColumns(20);
				
		return new FieldList(
			$textAreaField,
			new CheckboxField(
				$this->getSettingName('HideFromReports'),
				_t('EditableLiteralField.HIDEFROMREPORT', 'Hide from reports?'), 
				$this->getSetting('HideFromReports')
			)
		);
	}

	public function getFormField() {
		$label = $this->Title ? "<label class='left'>$this->Title</label>":"";
		$classes = $this->Title ? "" : " nolabel";
		
		return new LiteralField("LiteralField[$this->ID]", 
			"<div id='$this->Name' class='field text$classes'>
				$label
				<div class='middleColumn literalFieldArea'>". $this->getSetting('Content') ."</div>".
			"</div>"
		);
	}
	
	public function showInReports() {
		return (!$this->getSetting('HideFromReports'));
	}
}
