<?php namespace classes;

use DateTime;

/**
 * Class AuditLog
 *
 * @package classes
 */
class AuditLog {
    public int $Id;
    public string $Title;
    public string $Description;
    public DateTime $CreatedDate;
    public int $CreatedByUserId;

    /**
     * @param $auditLog
     *
     * @return bool
     */
    public function CreateAuditLog($auditLog) : bool
    {

    }

    /**
     *
     *
     * @param $startDate
     * @param $endDate
     * @param $pageNumber
     * @param $itemsPerPage
     *
     * @return array
     */
    public function GetAuditLogsByDateRange($startDate, $endDate, $pageNumber, $itemsPerPage) : array {

    }

    /**
     *
     *
     * @param $departmentId
     * @param $pageNumber
     * @param $itemsPerPage
     *
     * @return array
     */
    public function GetAuditLogsByDepartment($departmentId, $pageNumber, $itemsPerPage) : array {

    }

    /**
     *
     *
     * @param $userId
     * @param $pageNumber
     * @param $itemsPerPage
     *
     * @return array
     */
    public function GetAuditLogsByUser($userId, $pageNumber, $itemsPerPage) : array {

    }
}