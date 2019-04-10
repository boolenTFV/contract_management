<?php
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
	/**
	 * @dataProvider validationProvider
	 */
    public function testValidation($userParams, $expected)
    {
    	$department = new Department();
    	$department->name = $userParams[0];
    	$department->abbreviation = $userParams[1];
    	$department->code = $userParams[2];
        $isValid = $department->validation();
        if(!$isValid && IS_ECHO_ON){
            print_r($department->getMessages());
        }
        
        $this->assertSame($isValid, $expected);
    }

    public function validationProvider()
    {
        return [
            [[
            	'Научно-исследовательский сектор',
            	'НИС',
                null
            ], 'true'],
            [[
                'Кафедра "Информатика и вычислительная техника"',
                'ВИТ',
                '04'
            ], 'true'],
            [[
                '2123213213',
                'ВИТ',
                '4'
            ], false],
            [[
                '2123213213',
                'ВИТ',
                'фывфыв2'
            ], false],
            [[
                'Бухгалтерия',
                null,
                null
            ], 'true'],
        ];
    }
}