<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex as RegexValidator;

class Department extends SuperModel
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
     * @var string
     * @Column(column="name", type="string", length=45, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(column="abbreviation", type="string", length=10, nullable=true)
     */
    public $abbreviation;

    /**
     *
     * @var string
     * @Column(column="code", type="string", length=10, nullable=true)
     */
    public $code;

    /**
     * Инициализация модели
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("department");
        $this->hasMany('id', 'Contract', 'department_id', ['alias' => 'Contract']);
        $this->hasMany('id', 'Employee', 'department_id', ['alias' => 'Employee']);
        $this->hasMany('id', 'User', 'department_id', ['alias' => 'User']);
    }


    /**
     * Возвращает название таблицы БД
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'department';
    }

    /**
     * Валидация полей
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            [
                "name",
                "abbreviation",
                "code"
            ],
            new PresenceOf(
                [
                    "message" => [
                        "name" => "Название подразделения - обязательное поле"
                    ],
                ]
            )
        );

        return $this->validate($validator);
    }
}
