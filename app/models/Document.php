<?php
use  PhpOffice\PhpWord\TemplateProcessor;
class Document extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(column="contract_id", type="integer", length=11, nullable=false)
     */
    public $contract_id;

    /**
     *
     * @var string
     * @Column(column="template", type="string", length=255, nullable=true)
     */
    public $template;

    private $_file;

    public function saveFile($file){
        $this->_file = $file;
        $config = $this->getDI()->get('config');
        $filepath = $config->application->templatesDir.$this->template.'.docx';
        if(file_exists($filepath)){
            unlink($filepath); 
        }
        if(!$file->moveTo($filepath)){
            echo $filepath;
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function getFile($file){
        $filepath = $this->config->application->templatesDir.'/'.$this->template.'.docx';
        if(!$this->_file && file_exists($filepath)){
            $this->_file = file($filepath);
        }
    }

    public function generateDoc($contract=null){
        if($contract==null){
            $contract = $this->getContract();
        }

        $config = $this->getDI()->get('config');
        $templatePath = $config->application->templatesDir.'/'.$this->template.'.docx';
        $filepath = $config->application->fileDir.'/'.$this->template.'.docx';
        $templateProcessor = new TemplateProcessor($templatePath);
        $values = get_object_vars($contract);
        foreach ($values as $key => $value){
            $templateProcessor->setValue($key, $value);
        }

        $templateProcessor->saveAs($filepath);
        return 'files/'.$this->template.'.docx';

            
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("document");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Document[]|Document|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Document|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'document';
    }

}
