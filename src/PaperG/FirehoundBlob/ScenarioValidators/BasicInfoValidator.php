<?php
/**
 *
 * Author: zhiachong (zTime)
 * Time: 7/14/16 - 4:15 PM
 * Filename: BasicInfoValidator.php
 */

namespace PaperG\FirehoundBlob\ScenarioValidators;

use PaperG\FirehoundBlob\ScenarioBlob;

class BasicInfoValidator implements ScenarioValidator
{
    /**
     * Determines if a create blob is valid
     *
     * @param $blob ScenarioBlob
     *
     * @return ValidationResult
     */
    public function isValidCreateBlob($blob)
    {
        // Basic info should contain these information regardless
        // if it's a create or update request
        $validationResult = true;
        $validationMessage = '';

        $basicInfo = $blob->getBasicInfo();
        if (empty($basicInfo)) {
            return new ValidationResult(false, "Basic info is not filled. ");
        }

        $name = $basicInfo->getName();
        if (empty($name) || !is_string($name)) {
            $validationResult = false;
            $validationMessage .= "Basic info's name is not a valid string. ";
        }

        $uuid = $basicInfo->getUuid();
        if (empty($uuid) || !is_string($uuid)) {
            $validationResult = false;
            $validationMessage .= "Basic info's UUID is not a valid string. ";
        }

        $metadata = $basicInfo->getMetadata();
        if (!empty($metadata) && !is_string($metadata)) {
            $validationResult = false;
            $validationMessage .= "Basic info's metadata is not a valid string. ";
        }

        $scenario       = $basicInfo->getScenario();
        if (empty($scenario) ||
            !is_string($scenario)
        ) {
            $validationResult = false;
            $validationMessage .= "Basic info does not contain valid scenario. ";
        }

        return new ValidationResult($validationResult, $validationMessage);
    }

    /**
     * Determines if an update blob is valid
     *
     * @param $blob ScenarioBlob
     *
     * @return ValidationResult
     */
    public function isValidUpdateBlob($blob)
    {
        // Basic info should work the same for both create and update
        return $this->isValidCreateBlob($blob);
    }
}
