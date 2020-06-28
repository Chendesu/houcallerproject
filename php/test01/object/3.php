<?php 

// 类常量
class Computer {
  const YES = true;
  const NO = false;
  const ONE = 1;
  const TWO = self::ONE + 1; // 调用类里的常量
  const THREE = self::TWO + 1;
}

var_dump(Computer::THREE);

