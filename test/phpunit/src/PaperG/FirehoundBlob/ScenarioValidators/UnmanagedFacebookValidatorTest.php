<?php
/**
 *
 * Author: zhiachong (zTime)
 * Time: 7/18/16 - 3:42 PM
 * Filename: UnmanagedFacebookValidatorTest.php
 */

namespace PaperG\Common\Test;


use PaperG\FirehoundBlob\ScenarioValidators\UnmanagedFacebookValidator;

class UnmanagedFacebookValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UnmanagedFacebookValidator
     */
    private $sut;

    public function setup()
    {
        $this->sut = new UnmanagedFacebookValidator();
    }

    public function test_isValidCreateBlob_UsingAValidBlobForCreate_ReturnsTrue()
    {
        $mockScenarioBlob    = $this->getMockBuilder('PaperG\FirehoundBlob\ScenarioBlob')->disableOriginalConstructor()->getMock();
        $mockUnmanagedFbBlob = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\UnmanagedFacebookBlob')->disableOriginalConstructor()
                                    ->getMock();
        $mockAdSet           = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookAdSet')->disableOriginalConstructor()
                                    ->getMock();
        $mockCreative        = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookCreative')->disableOriginalConstructor()
                                    ->getMock();
        $mockCreative->expects($this->once())
                     ->method('isValid')
                     ->will($this->returnValue(true));

        $mockAdSet->expects($this->once())
                  ->method('validate')
                  ->will($this->returnValue(true));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdAccountId')
                            ->will($this->returnValue('123-abc'));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getPageId')
                            ->will($this->returnValue('123-abc'));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAccessToken')
                            ->will($this->returnValue('123-abc'));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getStatus')
                            ->will($this->returnValue('active'));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getCreatives')
                            ->will($this->returnValue([$mockCreative]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdSets')
                            ->will($this->returnValue([$mockAdSet]));
        $mockScenarioBlob->expects($this->once())
                         ->method('getBlob')
                         ->will($this->returnValue($mockUnmanagedFbBlob));

        $results = $this->sut->isValidCreateBlob($mockScenarioBlob);
        $this->assertEquals(true, $results->getResult());
    }

    public function test_isValidCreateBlob_UsingAValidBlobForCreate_WithIntPage_ReturnsTrue()
    {
        $mockScenarioBlob    = $this->getMockBuilder('PaperG\FirehoundBlob\ScenarioBlob')->disableOriginalConstructor()->getMock();
        $mockUnmanagedFbBlob = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\UnmanagedFacebookBlob')->disableOriginalConstructor()
            ->getMock();
        $mockAdSet           = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookAdSet')->disableOriginalConstructor()
            ->getMock();
        $mockCreative        = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookCreative')->disableOriginalConstructor()
            ->getMock();
        $mockCreative->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));

        $mockAdSet->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getAdAccountId')
            ->will($this->returnValue('123-abc'));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getPageId')
            ->will($this->returnValue(123));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getAccessToken')
            ->will($this->returnValue('123-abc'));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getStatus')
            ->will($this->returnValue('active'));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getCreatives')
            ->will($this->returnValue([$mockCreative]));
        $mockUnmanagedFbBlob->expects($this->once())
            ->method('getAdSets')
            ->will($this->returnValue([$mockAdSet]));
        $mockScenarioBlob->expects($this->once())
            ->method('getBlob')
            ->will($this->returnValue($mockUnmanagedFbBlob));

        $results = $this->sut->isValidCreateBlob($mockScenarioBlob);
        $this->assertEquals(true, $results->getResult());
    }

    public function test_isValidCreateBlob_UsingInvalidBlobForCreate_ReturnsFalseAndErrorMessage()
    {
        $mockScenarioBlob    = $this->getMockBuilder('PaperG\FirehoundBlob\ScenarioBlob')->disableOriginalConstructor()->getMock();
        $mockUnmanagedFbBlob = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\UnmanagedFacebookBlob')->disableOriginalConstructor()
                                    ->getMock();
        $mockAdSet           = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookAdSet')->disableOriginalConstructor()
                                    ->getMock();
        $mockCreative        = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookCreative')->disableOriginalConstructor()
                                    ->getMock();

        $mockAdSet->expects($this->once())
                  ->method('validate')
                  ->will($this->returnValue(true));
        $mockCreative->expects($this->once())
                     ->method('isValid')
                     ->will($this->returnValue(true));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdAccountId')
                            ->will($this->returnValue(1123));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getPageId')
                            ->will($this->returnValue([1, 2, 3]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAccessToken')
                            ->will($this->returnValue(["helloworld"]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getStatus')
                            ->will($this->returnValue(''));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getCreatives')
                            ->will($this->returnValue([$mockCreative]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdSets')
                            ->will($this->returnValue([$mockAdSet]));
        $mockScenarioBlob->expects($this->once())
                         ->method('getBlob')
                         ->will($this->returnValue($mockUnmanagedFbBlob));

        $results = $this->sut->isValidCreateBlob($mockScenarioBlob);
        $this->assertEquals(
            "Blob doesn't contain a valid ad account ID. Blob doesn't contain a valid page ID. Blob doesn't contain a valid access token. Blob doesn't contain valid status. ",
            $results->getMessage()
        );
        $this->assertEquals(false, $results->getResult());
    }

    public function test_isValidUpdateBlob_UsingInvalidBlobForUpdate_ReturnsFalseAndErrorMessage()
    {
        $mockScenarioBlob    = $this->getMockBuilder('PaperG\FirehoundBlob\ScenarioBlob')->disableOriginalConstructor()->getMock();
        $mockUnmanagedFbBlob = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\UnmanagedFacebookBlob')->disableOriginalConstructor()
                                    ->getMock();
        $mockAdSet           = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookAdSet')->disableOriginalConstructor()
                                    ->getMock();
        $mockCreative        = $this->getMockBuilder('PaperG\FirehoundBlob\Facebook\FacebookCreative')->disableOriginalConstructor()
                                    ->getMock();

        $mockAdSet->expects($this->once())
                  ->method('validate')
                  ->will($this->returnValue(true));
        $mockCreative->expects($this->once())
                     ->method('isValid')
                     ->will($this->returnValue(true));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdAccountId')
                            ->will($this->returnValue(1123));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getPageId')
                            ->will($this->returnValue([1, 2, 3]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAccessToken')
                            ->will($this->returnValue(["helloworld"]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getStatus')
                            ->will($this->returnValue(''));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getCreatives')
                            ->will($this->returnValue([$mockCreative]));
        $mockUnmanagedFbBlob->expects($this->once())
                            ->method('getAdSets')
                            ->will($this->returnValue([$mockAdSet]));
        $mockScenarioBlob->expects($this->once())
                         ->method('getBlob')
                         ->will($this->returnValue($mockUnmanagedFbBlob));

        $results = $this->sut->isValidUpdateBlob($mockScenarioBlob);
        $this->assertEquals(
            "Blob doesn't contain a valid ad account ID. Blob doesn't contain a valid page ID. Blob doesn't contain a valid access token. ",
            $results->getMessage()
        );
        $this->assertEquals(false, $results->getResult());
    }
}

