<?php

namespace PaperG\FirehoundBlob\Dcm;


use PaperG\FirehoundBlob\BlobInterface;
use PaperG\FirehoundBlob\Utility;

class UnmanagedDcmBlob implements BlobInterface
{
    use Utility;

    const PUBLICATION_ID = 'publicationId';
    const GOOGLE_ADVERTISER_ID = 'googleAdvertiserId';
    const CREATIVE_ASSETS = 'creativeAssets';
    const BATCH_ID = 'batchId';

    /**
     * @var int
     */
    private $publicationId;

    /**
     * @var int
     */
    private $advertiserId;

    /**
     * @var int
     */
    private $batchId;

    /**
     * @var DcmCreativeAsset[]
     */
    private $creativeAssets;

    public function __construct($array = [])
    {
        $this->fromArray($array);
    }

    public function toArray()
    {
        $assets =  [];
        foreach($this->creativeAssets as $asset) {
            $assets[] = $asset->toArray();
        }
        return [
            self::PUBLICATION_ID => $this->publicationId,
            self::GOOGLE_ADVERTISER_ID => $this->advertiserId,
            self::CREATIVE_ASSETS => $assets,
            self::BATCH_ID => $this->batchId
        ];
    }

    public function fromArray($array)
    {
        $this->publicationId = $this->safeGet($array, self::PUBLICATION_ID);
        $this->advertiserId = $this->safeGet($array, self::GOOGLE_ADVERTISER_ID);
        $assets = $this->safeGet($array, self::CREATIVE_ASSETS, []);
        $this->batchId = $this->safeGet($array, self::BATCH_ID);

        $this->creativeAssets = [];
        foreach($assets as $assetArray) {
            $this->creativeAssets[] = new DcmCreativeAsset($assetArray);
        }
    }

    /**
     * @param int $advertiserId
     */
    public function setAdvertiserId($advertiserId)
    {
        $this->advertiserId = $advertiserId;
    }

    /**
     * @return int
     */
    public function getAdvertiserId()
    {
        return $this->advertiserId;
    }

    /**
     * @param DcmCreativeAsset[] $creativeAssets
     */
    public function setCreativeAssets($creativeAssets)
    {
        $this->creativeAssets = $creativeAssets;
    }

    /**
     * @return DcmCreativeAsset[]
     */
    public function getCreativeAssets()
    {
        return $this->creativeAssets;
    }

    /**
     * @param int $publicationId
     */
    public function setPublicationId($publicationId)
    {
        $this->publicationId = $publicationId;
    }

    /**
     * @return int
     */
    public function getPublicationId()
    {
        return $this->publicationId;
    }

    /**
     * @param $batchId
     */
    public function setBatchId($batchId)
    {
        $this->batchId = $batchId;
    }

    /**
     * @param $batchId
     * @return int
     */
    public function getBatchId($batchId)
    {
        return $this->batchId;
    }
} 
