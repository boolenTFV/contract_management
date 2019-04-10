<?php
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
	/**
	 * @dataProvider validationProvider
	 */
    public function testValidation($userParams, $expected)
    {
    	$document = new Document();
    	$document->contract_id = $userParams[0];
    	$document->template = $userParams[1];
        $isValid = $document->validation();
        if(!$isValid && IS_ECHO_ON){
            print_r($document->getMessages());
        }
        $this->assertSame($isValid, $expected);
    }
    
    public function validationProvider()
    {
        return [
            [[
            	'1', 
            	'Договор'
            ], true],
            [[
                null,
                'Шаблон документа'
            ], true],
            [[
                '1',
                '/шаблон/документ'
            ], false],
            [[
                '1',
                null
            ], false],
        ];
    }
}