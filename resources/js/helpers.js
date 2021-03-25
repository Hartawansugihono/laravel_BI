function errorMessage(error) 
{
    var msg = '';
    Object.keys(error).map( (element) => {
        msg = msg + error[element] + '<br>'
    });
	return msg;
}

export {
    errorMessage
}