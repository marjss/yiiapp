<?php
/* @var $this GalleryController */
/* @var $model Gallery */
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
        'Galleries'=>array('gallery/admin'),
        'Upload Images',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => $this->breadcrumbs,
));
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gallery', 'url'=>array('index')),
	array('label'=>'Manage Gallery', 'url'=>array('admin')),
);
?>

<h1>Create Gallery</h1>
<?php echo $this->renderPartial('_form_1', array('model'=>$model),false,true); ?>