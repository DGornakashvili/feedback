<?php

namespace common\tests\acceptance;

use common\fixtures\FeedbackFixture;
use common\models\Feedback;
use common\tests\FunctionalTester;

class FeedbackCest
{
    protected $textOver256 = 'Some long text over 256 characters... '
    . 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
    . 'Autem, beatae commodi consectetur cumque dolor eius enim excepturi nemo, '
    . 'nobis obcaecati quam quos repellat sequi. Ab eveniet ex laborum optio placeat rem sequi, soluta.';

    public function _fixtures()
    {
        return [
            'feedback' => [
                'class' => FeedbackFixture::class,
                'dataFile' => codecept_data_dir() . 'feedback.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->seeRecord(Feedback::class, [
            'name' => 'divan',
            'phone' => '+7(999)999-99-99',
            'status' => 0,
        ]);
        $I->seeRecord(Feedback::class, [
            'name' => 'divan',
            'phone' => '+7(999)999-99-99',
            'status' => 0,
        ]);
    }
    
    public function tryToTest(FunctionalTester $I)
    {     
        $I->amOnPage('http://back.dev.local');
        $I->see('divan', 'td');
        $I->see('+7(999)999-99-99', 'td');
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->click('2', '.pagination');
        $I->see('anonymous', 'td');
        $I->see('+0(000)000-00-00', 'td');
        $I->seeLink('Front');
        $I->click('Front');
        $I->amOnUrl('http://front.dev.local');
        $I->see('', '#feedback-name');
        $I->see('', '#feedback-phone');
        $I->fillField('#feedback-name', $this->textOver256);
        $I->click('Submit');
        $I->see('Ошибка сохранения');
        $I->fillField('#feedback-name', 'FunctionalTester');
        $I->fillField('#feedback-phone', '+7-777-777-77-77');
        $I->click('Submit');
        $I->see('Ошибка сохранения');
        $I->fillField('#feedback-name', 'FunctionalTester');
        $I->fillField('#feedback-phone', '+7(777)777-77-77');
        $I->click('Submit');
        $I->see('Обращение сохранено');
        $I->seeLink('Back');
	    $I->click('Back');
        $I->amOnUrl('http://back.dev.local');
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->see('3', 'a');
        $I->click('2', '.pagination');
        $I->click('3', '.pagination');
        $I->see('FunctionalTester', 'td');
        $I->see('+7(777)777-77-77', 'td');
        $I->click('a[href="/site/view?id=3"]');
        $I->see('Update', 'a');
        $I->click('Update');
        $I->fillField('#feedback-name', 'Functional Tester');
        $I->fillField('#feedback-status', 1);
        $I->see('Save', 'button');
        $I->click('Save');
        $I->see('Feedback', 'a');
        $I->click('Feedback', '.breadcrumb');
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->see('3', 'a');
        $I->see('divan', 'td');
        $I->see('+7(999)999-99-99', 'td');
        $I->click('2', '.pagination');
        $I->see('anonymous', 'td');
        $I->see('+0(000)000-00-00', 'td');
        $I->click('3', '.pagination');
        $I->see('Functional Tester', 'td');
        $I->see('+7(777)777-77-77', 'td');
        $I->see('1', 'td');

        $I->seeRecord(Feedback::class, [
            'name' => 'divan',
            'phone' => '+7(999)999-99-99',
            'status' => 0,
        ]);
        $I->seeRecord(Feedback::class, [
            'name' => 'anonymous',
            'phone' => '+0(000)000-00-00',
            'status' => 0,
        ]);
        $I->seeRecord(Feedback::class, [
            'name' => 'Functional Tester',
            'phone' => '+7(777)777-77-77',
            'status' => 1,
        ]);
    }
}

