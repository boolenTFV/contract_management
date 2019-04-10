<?php

use  PhpOffice\PhpWord\TemplateProcessor;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class Document extends SuperModel
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


    /**
     * Сохранение файла
     */
    public function saveFile($file){
        $this->_file = $file;
        $config = $this->getDI()->get('config');
        $filepath = $config->application->templatesDir.$this->template.'.docx';
        if(file_exists($filepath)){
            unlink($filepath); 
        }
        if(!$file->moveTo($filepath)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Получение файла
     * 
     * @codeCoverageIgnore
     */
    public function getFile($file){
        $filepath = $this->config->application->templatesDir.'/'.$this->template.'.docx';
        if(!$this->_file && file_exists($filepath)){
            $this->_file = file($filepath);
        }
    }

    /**
     * удаление файла
     */
    public function deleteFile($file){
        $filepath = $this->config->application->templatesDir.'/'.$this->template.'.docx';
        if(!$this->_file && file_exists($filepath)){
            if(unlink($filepath)){
                return true;
            }
        }
        return false;
    }

    /**
     * Генерация файла doc из шаблона
     * 
     * @codeCoverageIgnore
     */
    public function generateDoc($contract=null){
        if($contract==null){
            $contract = $this->getContract();
        }
        echo $contract->contract_number;
        $config = $this->getDI()->get('config');
        $templatePath = $config->application->templatesDir.'/'.$this->template.'.docx';
        $filepath = $config->application->fileDir.'/'.$this->template.'.docx';
        $templateProcessor = new TemplateProcessor($templatePath);
        $values = $contract->getKeys();
        foreach ($values as $key){
            $templateProcessor->setValue($key, $contract->$key);
        }

        $templateProcessor->saveAs($filepath);
        return 'files/'.$this->template.'.docx';
    }

    /**
     * Инициализация модели
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("document");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
    }

    /**
     * Валидация бизнес логики
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            "template",
            new PresenceOf(
                [
                    "message" => "Введите название шаблона документа"
                ]
            )
        );
        return $this->validate($validator);
    }
}
