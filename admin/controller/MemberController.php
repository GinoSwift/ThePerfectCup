<?php
include_once __DIR__ . '/../model/Member.php';

class MemberController extends Member
{
    public function getMembers()
    {
        return $this->getMemberLists();
    }
}
