<?php

/**
 * GridView Export Behavior
 * 
 * Usage:
 * <pre>
 * //(Step 1) Add this behavior to the controller like
  public function behaviors() {
  return array(
  'exportableGrid' => array(
  'class' => 'application.components.ExportableGridBehavior',
  'attributes' => array('user.name', 'title', 'date',),
  ));
  }
 * //(Step 2) On actionAdmin() , add this line before render('admin') method
  $this->exportGrid($model);
 * //(Step 3) On the view that renders the grid, add the Export button like this
  $this->renderExportGridButton('Export Grid Results',array('class'=>'btn btn-info pull-right'));
 * </pre>
 * @version 1.0
 * @author Geronimo Oñativia / http://www.estudiokroma.com
 * @link http://www.yiiframework.com/extension/exportablegridbehavior
 */
class ExportableGridBehavior extends CBehavior {

    public $gridId = 'yw0';
    public $buttonId = 'export-button';
    public $stateVariable = '__export';
    public $exportParam = 'exportGrid';
    public $downloadParam = 'exportGridD';
    public $csvDelimiter = ',';
    public $csvEnclosure = '"';
    public $filename = 'export.csv';
    public $attributes = array();

    /**
     * @param CModel $model A model with attribute filters already loaded
     * @param array $attributes Attributes of $model to be exported. null to use "attributes" property provided on the behaviour definition.
     */
    public function exportGrid($model, $attributes = null) {
        if ($this->exportGridIsExportRequest()) {
            if ($attributes == null)
                $this->generateFileOnMem($model, $this->attributes);
            else
                $this->generateFileOnMem($model, $attributes);
            Yii::app()->end();
        } else if ($this->exportGridIsDownloadRequest()) {
            $this->outputFileOnMem();
            Yii::app()->end();
        }
    }
    
    public function exportGridIsExportRequest(){
        return Yii::app()->request->getParam($this->exportParam);
    }
    
    public function exportGridIsDownloadRequest(){
        return Yii::app()->request->getParam($this->downloadParam);
    }

    public function renderExportGridButton($label = 'Export', $htmlOptions = array()) {
        $fileDownloadUrl = $this->getOwner()->createUrl($this->getOwner()->getAction()->getId(), array($this->downloadParam => 1));
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id'] = $this->buttonId;
        }
        echo CHtml::button($label, $htmlOptions);
        Yii::app()->clientScript->registerScript('exportgrid', "
$('#" . $htmlOptions['id'] . "').on('click',function() {
    var grid=$('#" . $this->gridId . "');
    var dataVar=grid.yiiGridView('getUrl');
    var idx=dataVar.indexOf('?');
    dataVar=((idx>=0)?dataVar.substring(idx):'')+'&" . $this->exportParam . "=1';
    grid.yiiGridView('update', {
        success: function() {
            grid.removeClass('grid-view-loading');
            window.location = '" . $fileDownloadUrl . "';
        },
        data: dataVar
    });
}); 
");
    }

    private function generateFileOnMem($model,$attributes) {
        $fp = fopen('php://temp', 'w');
        /**
         * Put Headers 
         */
        $row = array();
        foreach ($attributes as $attr) {
            $row[] = $model->getAttributeLabel($attr);
        }
        fputcsv($fp, $row, $this->csvDelimiter, $this->csvEnclosure);
        /**
         * Put rows 
         */
        $provider = $model->search();
        $provider->setPagination(null);
        $iterator = new CDataProviderIterator($provider);
        foreach ($iterator as $m) {
            $row = array();
            foreach ($attributes as $attr) {
                $row[] = CHtml::value($m, $attr);
            }
            fputcsv($fp, $row, $this->csvDelimiter, $this->csvEnclosure);
        }
        rewind($fp);
        Yii::app()->user->setState($this->stateVariable, stream_get_contents($fp));
        fclose($fp);
    }

    private function outputFileOnMem() {
        Yii::app()->request->sendFile($this->filename, Yii::app()->user->getState($this->stateVariable));
        Yii::app()->user->setState($this->stateVariable, NULL);
    }

}

?>
