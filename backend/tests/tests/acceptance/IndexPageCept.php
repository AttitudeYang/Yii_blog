<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');   
$I->see('登录');
// $I->amGoingTo('submit login form with no data');
// $I->fillField('input[name="LoginForm[username]"]', '');
// $I->fillField('input[name="LoginForm[password]"]', '');
// $I->click('登录');//点击登录按钮
// $I->expectTo('see validations errors');
// $I->see('用户名不能为空。', '.help-block');//希望看到用户名的错误提示
// $I->see('密码不能为空。', '.help-block');//希望看到密码的错误提示
