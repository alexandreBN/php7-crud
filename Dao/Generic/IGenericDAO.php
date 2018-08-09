<?php

interface IGenericDAO {
    public function get($id);
    public function delete($id);
    public function getAll();
}