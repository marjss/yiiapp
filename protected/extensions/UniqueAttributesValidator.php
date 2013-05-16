<?php
/**
 * Yii Unique Attribute Validator extension helps to uniquely identify or validate the particualr attribute with fk.
 * Created by: Sudhanshu Saxena
 * 
 */

class UniqueAttributesValidator extends CValidator {

	public $with;

	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 */
	protected function validateAttribute($object,$attribute) {
		$with = explode(",", $this->with);
//                print_r($with) ;
		if (count($with) < 1)
			throw new Exception("Attribute 'with' not set");
		$uniqueValidator = new CUniqueValidator();
		$uniqueValidator->attributes = array($attribute);
		$uniqueValidator->message = $this->message;
//                echo'<pre>';
//                print_r($uniqueValidator);
//                echo'</pre>';
		$uniqueValidator->on = $this->on;
		$conditionParams = array();
		$params = array();
		foreach ($with as $attribute) {
//                    echo $object->$attribute;
			$conditionParams[] = "`{$attribute}`=:{$attribute}";
			$params[":{$attribute}"] = $object->$attribute;
//                        print_r($params);
		}
		$condition = implode(" AND ", $conditionParams);
//                print_r($condition);
		$uniqueValidator->criteria = array(
			'condition'=>$condition,
			'params'=>$params
		);
		$uniqueValidator->validate($object);
	}
}
?>
