<?php

namespace common\tests\acceptance;

use common\fixtures\FeedbackFixture;
use common\tests\AcceptanceTester;

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

    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(1);
        $I->see('divan', 'td');
        $I->see('+7(999)999-99-99', 'td');
        $I->wait(1);
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->wait(1);
        $I->click('2', '.pagination');
        $I->wait(1);
        $I->see('anonymous', 'td');
        $I->see('+0(000)000-00-00', 'td');
        $I->wait(1);
        $I->seeLink('Front');
        $I->click('Front');
        $I->wait(1);
        $I->seeElement('#feedback-name');
        $I->seeElement('#feedback-phone');
        $I->fillField('#feedback-name', $this->textOver256);
        $I->wait(1);
        $I->click('Submit');
        $I->wait(1);
        $I->see('ФИО should contain at most 256 characters.');
        $I->see('Телефон cannot be blank.');
        $I->wait(1);
        $I->fillField('#feedback-name', 'AcceptanceTester');
        $I->wait(1);
        $I->fillField('#feedback-phone', '+7-888-888-88-88');
        $I->wait(1);
        $I->click('Submit');
        $I->wait(1);
        $I->see('Incorrect phone format.');
        $I->wait(1);
        $I->fillField('#feedback-phone', '+7(888)888-88-88');
        $I->wait(1);
        $I->click('Submit');
        $I->wait(1);
        $I->see('Обращение сохранено');
        $I->wait(1);
        $I->seeLink('Back');
        $I->click('Back');
        $I->wait(1);
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->see('3', 'a');
        $I->wait(1);
        $I->click('2', '.pagination');
        $I->wait(1);
        $I->click('3', '.pagination');
        $I->wait(1);
        $I->see('AcceptanceTester', 'td');
        $I->see('+7(888)888-88-88', 'td');
        $I->wait(1);
        $I->click('a[href="/site/view?id=3"]');
        $I->wait(1);
        $I->see('Update', 'a');
        $I->click('Update');
        $I->wait(1);
        $I->clearField('#feedback-name');
        $I->wait(1);
        $I->fillField('#feedback-name', 'Acceptance Tester');
        $I->wait(1);
        $I->clearField('#feedback-status');
        $I->wait(1);
        $I->fillField('#feedback-status', 1);
        $I->wait(1);
        $I->see('Save', 'button');
        $I->click('Save');
        $I->wait(1);
        $I->see('Feedback', 'a');
        $I->click('Feedback', '.breadcrumb');
        $I->wait(1);
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->see('3', 'a');
        $I->wait(1);
        $I->click('2', '.pagination');
        $I->wait(1);
        $I->click('3', '.pagination');
        $I->wait(1);
        $I->click('a[href="/site/delete?id=3"]');
        $I->wait(1);
        $I->acceptPopup();
        $I->see('divan', 'td');
        $I->see('+7(999)999-99-99', 'td');
        $I->wait(1);
        $I->see('1', 'a');
        $I->see('2', 'a');
        $I->wait(1);
        $I->click('2', '.pagination');
        $I->wait(1);
        $I->see('anonymous', 'td');
        $I->see('+0(000)000-00-00', 'td');
        $I->wait(1);
    }
}
