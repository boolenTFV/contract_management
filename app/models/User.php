<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;


class User extends SuperModel
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
     * @Column(column="surname", type="string", length=45, nullable=true)
     */
    public $surname;

    /**
     *
     * @var string
     * @Column(column="patronymic", type="string", length=45, nullable=true)
     */
    public $patronymic;

    /**
     *
     * @var string
     * @Column(column="email", type="string", length=45, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(column="pass", type="string", length=65, nullable=true)
     */
    public $pass;


    public $is_active;

    /**
     *
     * @var string
     * @Column(column="type", type="string", nullable=true)
     */
    public $type;

    /**
     *
     * @var integer
     * @Column(column="department_id", type="integer", length=11, nullable=true)
     */
    public $department_id;

    /**
     * Валидация бизнес логики
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            [
                "name",
                "surname",
                "email",
                "pass",
                "type",
                "department_id"
            ],
            new PresenceOf(
                [
                    "message" => [
                        "name" => "Имя - обязательное поле",
                        "surname" => "Фамилия - обязательное поле",
                        "patronymic" => "Отчество - обязательное поле",
                        "email" => "Email - обязательное поле",
                        "pass" => "Пароль - обязательное поле",
                        "type" => "Тип пользователя не указан",
                        "department_id" => "Отчество - обязательное поле"
                    ],
                ]
            )
        );
        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Введеный вами email не валиден',
                ]
            )
        );
        $pattern = "/^[А-Яа-я-]{2,40}$/u";
        $validator->add(
            [
                "name",
                "surname",
                "patronymic",
            ],
            new RegexValidator(
                [
                    "pattern" => [
                        "name" => $pattern,
                        "surname"       => $pattern,
                        "patronymic" => "/^(|[А-Яа-я-]{1,40})$/u"
                    ],
                    "message" => [
                        "name" => 
                            "Имя может содержать только символы 
                                русского алфавита или символ дефис",
                        "surname"       => 
                            "Фамилия может содержать только символы 
                                русского алфавита и символ дефис",
                        "patronymic" => 
                            "Отчество может содержать только символы 
                                русского алфавита и символ дефис",
                    ]
                ]
            )
        );
        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("user");
        $this->belongsTo('department_id', '\Department', 'id', ['alias' => 'Department']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }
}
