// JavaScript Document
function MyString(str){
	this.str = str;
	
	this.getString = function(){
		return this.str;
		}
	
	//截去串头部的空格
	function ltrim(str){
		var i = 0;
		while(str.charAt(i)==' '){
				++i;	
			}
			
		return str.substring(i,str.length);
		}
		
	//截去串尾部的空格
	function rtrim(str){
			var i =str.length-1;
			while(str.charAt(i)==' '){
					--i;
				}
			return str.substring(0,i+1);
		}
	//执行截尾工作
	function trim(str){
		
		return	ltrim(rtrim(str));
		}
	this.str = trim(this.str);
}