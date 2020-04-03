# php开发项目的一些方法和问题解决方式



### 编程小技巧

> 1. map操作

​	**模拟数据：**

```php
//返回数据
$outputData = [
   // [
       // 'id' => '',
       // 'studentName' => '',
       // 'score' => '',
   // ],
];
//模拟学生表数据
$mockStudentData = [
    [
        'id' => 1,
        'name' => '张三',
    ],
    [
        'id' => 2,
        'name' => '李四',
    ],
    [
        'id' => 3,
        'name' => '王五',
    ],
];
//模拟学生成绩表数据
$mockStudentScoreData = [
    [
        'id' => 1,
        'studentID' => 1,
        'score' => 90,
    ],
    [
        'id' => 2,
        'studentID' => 2,
        'score' => 90,
    ],
    [
        'id' => 3,
        'studentID' => 3,
        'score' => 90,
    ],
];
```

​    **操作:**

```php
//定义map数组
$mapStudent = [];
foreach($mockStudentData as $mockStudentValue){
    //以id为下标
    $mapStudent[$mockStudentValue['id']] = $mockStudentValue['name'];
}
foreach($mockStudentScoreData as $mockStudentScoreValue){
    $item = [
        'studentScoreID' => $mockStudentScoreValue['id'],
        'score' => $mockStudentScoreValue['score'],
        'studentName' => $mapStudent[$mockStudentScoreValue['id']],
    ];
    $outputData[] = $item;
}
return $outputData;
```

##### 备注：

上面例子student为主表，studentScore为从表，通过主表的主键做map的key（**核心点也就是两个数据的关联点做key**），遍历从表数据，进行匹配到了map中的key对应的就是他的父级数据。