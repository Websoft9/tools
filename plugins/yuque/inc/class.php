<?php

class Yuque {

    var $yuque_repository;
    var $yuque_user;
    var $yuque_token;
    
    //项目URL
    var $doc_link;
    
    //第一级目录的编号游标
    var $FirstClass=1;
    

    //构造函数，用于初始化对象属性
    function __construct( $par1, $par2, $par3, $par4 ) {
        $this->yuque_repository = $par1;
        $this->yuque_user = $par2;
        $this->yuque_token= $par3;
        $this->doc_link= $par4;


        //初始化项目URL
        $this->doc_link=$this->doc_link.$this->yuque_repository;

     }
    
    
    //输出三列数据
    function main_display()
    {
        
        $TocToSite=array();

        //分块名称
        $doc_chapter=array();


        $doc_chapter=$this->print_chapterTile($this->getDocToc());
        //$doc_chapter[0]="Getting Started";
        

        for($i=0;$i<3;$i++)
        {
           
           $TocToSite[$i]=$this->print_chapter($this->getDocToc(),$i);
           
        }
        
        for ($i=0;$i<3;$i++)
        {
            echo "<div class=\"col\">\n"; 
            echo "       <div class=\"card\" >\n"; 
            echo "  \n"; 
            echo "  <div class=\"card-body\">\n"; 
            echo "    <h5 class=\"card-title\">$doc_chapter[$i]</h5>\n"; 
            echo "    <p class=\"card-text\">$TocToSite[$i]</p>\n"; 
            echo "    <a href=\"$this->doc_link\start\" target=\"_blank\" class=\"btn btn-outline-dark\">More</a>\n"; 
            echo "  </div>\n"; 
            echo "</div>\n"; 
            echo "    </div>\n";
            
        }    
    }

    //输出文档overview
    function overview_display()
    {
        $url="https://www.yuque.com/api/v2/repos/webs/$this->yuque_repository/docs/readme";
        $output=$this->StrFromYuque($url);

        //对获取的JSON文件进行数组化,通过print_r($doc_toc)可以查看数组
        $doc_toc=json_decode($output, true); 
        $doc_toc=$doc_toc["data"]["body_html"];

        //字符串转换的地方还存在bug，中文会乱码，英文单词会显示不完整
        $doc_toc=substr($doc_toc,0,350);
        $doc_toc="<p>".strip_tags($doc_toc)."...</p>";
        
        print_r($doc_toc);

    }
    
    
    //获取知识库目录信息
    function getDocToc()
    {
        $url="https://www.yuque.com/api/v2/repos/webs/$this->yuque_repository/toc";

        $output=$this->StrFromYuque($url);

        //对获取的JSON文件进行数组化,通过print_r($doc_toc)可以查看数组
        $doc_toc=json_decode($output, true); 

        //print_r($doc_toc);
        
        return $doc_toc;
        
    }

    function StrFromYuque($myurl){

        // 1. 初始化
        $ch = curl_init();        
    
        // 2. 设置选项，包括URL
        curl_setopt($ch,CURLOPT_URL,$myurl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_USERAGENT,$this->yuque_user);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-type: text/plain", "X-Auth-Token: $this->yuque_token"));
    
        // 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        if($output === FALSE )
        {
        echo "CURL Error:".curl_error($ch);
        }
    
        // 4. 释放curl句柄
        curl_close($ch);

        return $output;
        

    }

    //输出标题（一级目录）
    function print_chapterTile($str)
    {
        $j=0;
        $arrlength=count($str["data"]);
        $StrForReturn=array();

        for ($i=1;$i<$arrlength;$i++)
        {
            if ($str["data"][$i]["depth"]==1)
            {
                $StrForReturn[$j]=$str["data"][$i]["title"];
                $j=$j+1;
            }
            
        }
        return $StrForReturn;
    }

    //按列分别输出文档目录
    
    function print_chapter($str,$col)
    {
        
        $StrForReturn;
    
        //输出 Get Started
        if ($col==0)
        {
            //输出Overview
            //$StrForReturn=$StrForReturn."<a href=".$this->doc_link."/".$str["data"][0]["slug"]." target=_blank >".$str["data"][0]["title"]."</a><br>";
            $StrForReturn=$StrForReturn."<a href=".$this->doc_link."/".$str["data"][1]["slug"]." target=_blank >".$str["data"][1]["title"]."</a><br>";
                  
            for($i=2;$str["data"][$i]["depth"]>1;$i++)
    
            {
                if($str["data"][$i]["depth"]==2)
                {
                    //处理章节是外链的情况
                    if (strpos($str["data"][$i]["slug"],'http') !== false)
                    {
                        $StrForReturn=$StrForReturn."<a href=".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";
                    }
                    else
                    $StrForReturn=$StrForReturn."<a href=".$this->doc_link."/".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";
                }

            //游标跳跃到本类别最后一个第二级目录
            $this->FirstClass=$i+2;
    
            }

            return $StrForReturn;
            
        }
    
        //输出 Best Practise
        if ($col==1)
    
        {
            for($i=$this->FirstClass;$str["data"][$i]["depth"]>1;$i++)
    
            {
                if($str["data"][$i]["depth"]==2)
                {
                    if (strpos($str["data"][$i]["slug"],'http') !== false)
                    {
                        $StrForReturn=$StrForReturn."<a href=".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";
                    }
                    else
                    $StrForReturn=$StrForReturn."<a href=".$this->doc_link."/".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";
                }
    
            //游标跳跃到本类别最后一个第二级目录
            $this->FirstClass=$i+2;
                
            }
            
            return $StrForReturn;
            
        }
    
        //输出 Administrator(实际上输出的是Administrator之后的所有内容)
        if ($col==2)
        {        
            for($i=$this->FirstClass;$str["data"][$i]["depth"]>0;$i++)
    
            {
                 if($str["data"][$i]["depth"]==2)
                 {
                    if (strpos($str["data"][$i]["slug"],'http') !== false)
                    {
                        $StrForReturn=$StrForReturn."<a href=".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";
                    }
                    else
                    $StrForReturn=$StrForReturn."<a href=".$this->doc_link."/".$str["data"][$i]["slug"]." target=_blank >".$str["data"][$i]["title"]."</a><br>";                
                 }
    
            //游标跳跃到本类别最后一个第二级目录
            $this->FirstClass=$i+2;
                 
            }
    
            return $StrForReturn;
            
        }
    }
}

?>