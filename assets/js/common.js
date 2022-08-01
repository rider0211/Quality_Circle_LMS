$.fn.param = function(name, value) {
    if(value==undefined) {
        if(typeof name=="object") {
            for(f in name) {
                $(this).param(f,name[f]);
            }
            return this;
        } else
            return $("[name='"+name+"']",this).val();
    }
    input = $("[name='"+name+"']",this);
    if(input.length==0)
        $(this).append($("<input type='hidden' name='"+name+"' value='"+value+"'/>"));
    else
        input.val(value);
    return this;
};
$.fn.params = function() {
    var inputs = $("input,select,textarea",this);
    var data = {};
    inputs.each(function(i,el) {
        var v = $(el).val();
        if(el.type=="checkbox" && !el.checked)
            return;
        if(el.type=="radio" && !el.checked)
            return;
        if(!data[$(el).attr("name")])
            data[$(el).attr("name")] = v;
        else {
            if(typeof data[$(el).attr("name")]!="object") 
                data[$(el).attr("name")] = [data[$(el).attr("name")]];
            data[$(el).attr("name")].push(v);
        }
    });
    return data;
};
function upperString( str ) {
	return str.toUpperCase();
}

function transformTimeStamp(stime) {
	var str_timestamp;
	
	var hh;
	var mm;
	var ss;

	hh = Math.floor(Number(stime).valueOf() / 3600);
	ss = Number(stime).valueOf() - hh * 3600;
	mm = Math.floor(Number(ss).valueOf() / 60);
	ss = Number(ss).valueOf() - mm * 60;

	str_timestamp = "";
	
	if(Number(hh).valueOf() < 10) {
		str_timestamp += "0"+Number(hh).valueOf()+":";
	} else {
		str_timestamp += Number(hh).valueOf()+":";
	}
	
	if(Number(mm).valueOf() < 10) {
		str_timestamp += "0"+Number(mm).valueOf()+":";
	} else {
		str_timestamp += Number(mm).valueOf()+":";
	}


	if(Number(ss).valueOf() < 10) {
		str_timestamp += "0"+Number(ss).valueOf();
	} else {
		str_timestamp += Number(ss).valueOf();
	}
	
	return str_timestamp;
}