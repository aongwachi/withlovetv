<?php
$date = new DateTime();
$week = $date->format("W");
$year = $date->format("Y");
$gendate = new DateTime();
$gendate->setISODate($year,$week,1);
$dateStr = $gendate->format('d-m-Y');