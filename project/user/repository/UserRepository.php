<?php

use entity\User;

interface UserRepository {
    function findByUserPhone($phone);
    function findByUserEmail($email);
    function findById($id);
    function save(User $user);
    function findAll();
}