<?php

namespace PaperG\Common\Test\Dcm\Validators;

use PaperG\FirehoundBlob\Dcm\UnmanagedDcmBlob;
use PaperG\FirehoundBlob\Dcm\Validators\UnmanagedDcmBlobValidator;
use PaperG\FirehoundBlob\ScenarioBlob;

class UnmanagedDcmBlobValidatorTest extends \FirehoundBlobTestCase
{
    /**
     * @var UnmanagedDcmBlobValidator
     */
    private $sut;
    private $mockValidator;

    public function setUp() {
        $this->mockValidator = $this->buildMock('PaperG\FirehoundBlob\Dcm\Validators\DcmCreativeAssetValidator');
        $this->sut = new UnmanagedDcmBlobValidator($this->mockValidator);
    }

    public function testIsValidCreateBlob() {
        $mockValidationResult = $this->buildMock('PaperG\FirehoundBlob\ScenarioValidators\ValidationResult');
        $this->addExpectation($mockValidationResult, $this->once(), 'getResult', null, true);
        $mockCreativeAsset = $this->buildMock('PaperG\FirehoundBlob\Dcm\DcmCreativeAsset');
        $mockAssets = [$mockCreativeAsset];

        $this->addExpectation($this->mockValidator, $this->once(), 'isValidCreate', null, $mockValidationResult);

        $dcmBlob = new UnmanagedDcmBlob();
        $dcmBlob->setAdvertiserId(1234);
        $dcmBlob->setCreativeAssets($mockAssets);
        $dcmBlob->setPublicationId(1234);

        $testBlob = new ScenarioBlob();
        $testBlob->setBlob($dcmBlob);
        $this->sut->isValidCreateBlob($testBlob);
    }

    public function testIsValidUpdateBlob() {
        $mockValidationResult = $this->buildMock('PaperG\FirehoundBlob\ScenarioValidators\ValidationResult');
        $this->addExpectation($mockValidationResult, $this->once(), 'getResult', null, true);

        $mockCreativeAsset = $this->buildMock('PaperG\FirehoundBlob\Dcm\DcmCreativeAsset');
        $mockAssets = [$mockCreativeAsset];

        $this->addExpectation($this->mockValidator, $this->once(), 'isValidUpdate', null, $mockValidationResult);

        $dcmBlob = new UnmanagedDcmBlob();
        $dcmBlob->setAdvertiserId(1234);
        $dcmBlob->setCreativeAssets($mockAssets);
        $dcmBlob->setPublicationId(1234);

        $testBlob = new ScenarioBlob();
        $testBlob->setBlob($dcmBlob);
        $this->sut->isValidUpdateBlob($testBlob);
    }
} 
