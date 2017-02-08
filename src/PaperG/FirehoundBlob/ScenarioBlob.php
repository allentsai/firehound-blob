<?php

namespace PaperG\FirehoundBlob;

use PaperG\FirehoundBlob\AppNexus\AppNexusBlob;
use PaperG\FirehoundBlob\Dcm\UnmanagedDcmBlob;
use PaperG\FirehoundBlob\Facebook\UnmanagedFacebookBlob;

class ScenarioBlob implements BlobInterface
{
    use Utility;

    const BASIC_INFO = 'basicInfo';
    const BLOB = 'blob';

    /**
     * @var BasicInfo
     */
    private $basicInfo;

    /**
     * @var BlobInterface
     */
    private $blob;

    public function __construct($array = null)
    {
        $this->fromArray($array);
    }

    /**
     * @param \PaperG\FirehoundBlob\BasicInfo $basicInfo
     */
    public function setBasicInfo($basicInfo)
    {
        $this->basicInfo = $basicInfo;
    }

    /**
     * @return \PaperG\FirehoundBlob\BasicInfo
     */
    public function getBasicInfo()
    {
        return $this->basicInfo;
    }

    /**
     * @param \PaperG\FirehoundBlob\BlobInterface $blob
     */
    public function setBlob($blob)
    {
        $this->blob = $blob;
    }

    /**
     * @return \PaperG\FirehoundBlob\BlobInterface
     */
    public function getBlob()
    {
        return $this->blob;
    }

    public function fromArray($array)
    {
        $this->basicInfo = new BasicInfo($this->safeGet($array, self::BASIC_INFO));

        $scenario = $this->basicInfo->getScenario();

        $blobArray = $this->safeGet($array, self::BLOB);
        switch ($scenario) {
            case Scenario::FB_UNMANAGED:
                $this->blob = new UnmanagedFacebookBlob($blobArray);
                break;
            case Scenario::DCM_UNMANAGED:
                $this->blob = new UnmanagedDcmBlob($blobArray);
                break;
            case Scenario::AN_DESKTOP:
            case Scenario::AN_MOBILE:
                $this->blob = new AppNexusBlob($blobArray);
                break;
            default:
                break;
        }
    }

    public function toArray()
    {
        return [
            self::BASIC_INFO => $this->basicInfo->toArray(),
            self::BLOB => $this->blob->toArray()
        ];
    }
} 
