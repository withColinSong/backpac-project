<?php


include($_SERVER['DOCUMENT_ROOT'] . "/user/repository/AdminQueryRepository.php");

/**
 * @WRITE : yj.song
 * @Content : 관리자 요청 화면
 */
class AdminRepositoryQueryImpl implements AdminQueryRepository {

    public function findAllSubQueryLastOrderItem() {
        $sql = "
                SELECT IU.ID,
                       IU.NAME,
                       IU.NICKNAME,
                       IU.PHONE,
                       IU.EMAIL,
                       IU.GENDER,
                    (SELECT ORDER_NAME
                     FROM IDUS_ORDER IO
                     WHERE IO.USER_ID = IU.ID
                     ORDER BY IO.ORDER_DATETIME DESC LIMIT 1) AS LAST_ORDER_ITEM
                FROM IDUS_USER IU
                WHERE 1=1
                ";

        return $sql;
    }

    public function andName($name) {
        $sql = " AND NAME LIKE '%{$name}%'";
        return $sql;
    }

    public function andEmail($email) {
        $sql = " AND EMAIL LIKE '%{$email}%'";
        return $sql;
    }

    public function limit($limit, $page) {
        $sql = " LIMIT $limit, $page";
        return $sql;
    }

}