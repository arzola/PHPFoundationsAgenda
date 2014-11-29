<?php

interface Storage{
    public function add($data);
    public function update($id);
    public function find($id);
    public function delete($id);
    public function fetchAll();
}