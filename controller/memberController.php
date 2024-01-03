<?php
include_once 'model/member.php';

class MemberController extends Member
{
    public function newMembers($data)
    {
        return $this->memberAccRegister($data);
    }
}
