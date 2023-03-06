<?php

interface OrderRepository {
    function findOrderByUserId($userId);
}