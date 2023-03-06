<?php

interface AdminQueryRepository {
    function findAllSubQueryLastOrderItem();
    function andName($name);
    function andEmail($email);
}