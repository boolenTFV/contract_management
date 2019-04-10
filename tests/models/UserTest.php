<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	/**
	 * @dataProvider validationProvider
	 */
    public function testValidation($userParams, $expected)
    {
    	$user = new User();
    	$user->name = $userParams[0];
    	$user->surname = $userParams[1];
    	$user->patronymic = $userParams[2];
    	$user->email = $userParams[3];
    	$user->pass = $userParams[4];
    	$user->is_active = $userParams[5];
    	$user->type = $userParams[6];
    	$user->department_id = $userParams[6];
        $contract = new Contract();
        $isValid = $user->validation();
        if(!$isValid && IS_ECHO_ON){
            print_r($user->getMessages());
        }
        
        $this->assertSame($user->validation(), true);
    }

    public function validationProvider()
    {
        return [
            [[
            	'Жан-Жак',
            	'Ниолайр',
            	null,
            	'russo@mail.com',
            	'testpass1234',
            	'active',
            	'user',
            	'1'
            ], 'true'],
            [[
            	'Жан-Жак',
            	'Руссо',
            	null,
            	'russo@mail.com',
            	'testpass1234',
            	'active',
            	'user',
            	'1'
            ], 'true'],
            [[
            	'Жан-Жак',
            	'Руссо',
            	null,
            	'russo@mail.com',
            	'testpass1234',
            	'active',
            	'user',
            	'1'
            ], 'true'],
            [[
            	'Жан-Жак',
            	'Николай',
            	null,
            	'russo@mail.com',
            	'testpass1234',
            	'active',
            	'user',
            	'1'
            ], 'true'],
        ];
    }
}