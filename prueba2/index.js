var express = require('express')
var axios = require('axios')

const app = express()
app.set('port', 5500)

//index
app.get('/', async (req, res) => {
    try{
        let config = {
            method: 'get',
            url: 'https://my-json-server.typicode.com/rucardona16/notificaciones/stateRecords',
            headers: { }
        };
        let results = await axios(config)
        return res.status(200).json(results.data);	
    }catch(error) {
        console.log(error);
    }
})

app.get('/:email', async (req, res) => {
    try{
        let config = {
            method: 'get',
            url: 'https://my-json-server.typicode.com/rucardona16/notificaciones/stateRecords',
            headers: { }
        };
        let results = await axios(config)
        if( req.params.email ){
            let filterResults = []
            for( let emails in results.data ){ 
                for( let events in results.data[emails] ){
                    for( let value in results.data[emails][events] ){
                        if( results.data[emails][events][value].targetEmail == req.params.email ){
                            filterResults.push(results.data[emails][events][value])
                        }
                    }
                }
            }
            return res.status(200).json(filterResults);	
        }
    }catch(error) {
        console.log(error);
    }
})

app.listen(app.get('port'), () => {
	console.log('Server iniciado en puerto: '+app.get('port'))
})

module.exports = app