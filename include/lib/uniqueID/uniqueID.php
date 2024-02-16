<?php
function getUniqueID() {
  static $id = 0;
  return ++$id;
}