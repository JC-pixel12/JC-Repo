<?php
function ensureAuditTable($auditConn)
{
    if (!$auditConn || $auditConn->connect_error) {
        return false;
    }

    $auditConn->query('CREATE DATABASE IF NOT EXISTS db_user_profile');
    $auditConn->query("CREATE TABLE IF NOT EXISTS tbl_audit (
        id INT AUTO_INCREMENT PRIMARY KEY,
        seller_id INT NOT NULL,
        action_date DATE NOT NULL,
        action_time TIME NOT NULL,
        action VARCHAR(100) NOT NULL
    )");

    return true;
}

function logAuditAction($auditConn, $sellerId, $action)
{
    if (!$auditConn || $auditConn->connect_error) {
        return false;
    }

    ensureAuditTable($auditConn);

    $sellerId = (int)$sellerId;
    $action = trim((string)$action);
    if ($sellerId <= 0 || $action === '') {
        return false;
    }

    $actionEsc = mysqli_real_escape_string($auditConn, $action);
    $actionDate = date('Y-m-d');
    $actionTime = date('H:i:s');

    return mysqli_query($auditConn, "INSERT INTO tbl_audit (seller_id, action_date, action_time, action) VALUES ($sellerId, '$actionDate', '$actionTime', '$actionEsc')");
}

function getAuditEntries($auditConn)
{
    if (!$auditConn || $auditConn->connect_error) {
        return false;
    }

    ensureAuditTable($auditConn);
    return mysqli_query($auditConn, 'SELECT a.seller_id, a.action_date, a.action_time, a.action, s.first_name, s.last_name, s.email FROM tbl_audit a LEFT JOIN tbl_seller s ON a.seller_id = s.id ORDER BY a.action_date DESC, a.action_time DESC');
}
?>
