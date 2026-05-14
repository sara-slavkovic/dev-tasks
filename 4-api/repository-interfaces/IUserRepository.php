<?php
interface IUserRepository {
    public function findByEmail($email);
    public function save(User $user);
}