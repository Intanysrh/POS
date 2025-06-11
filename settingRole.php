<?php
function group1()
{
    return ['5'];
}
function group2()
{
    return ['7'];
}
function group3()
{
    // 1=PIC, 2=Admin, 3=Helper, 6=Leader
    return ['1', '2', '3', '6'];
}
function role_available()
{
    // id dari instructor=5, students=7
    return ['5', '7'];
}
// in array
function canAddModul($role)
{
    if (in_array($role, group1())) {
        return true;
    }
}
?>