class Evento {

        // idEvento;
        // idCita;
        // idUsr;
        // fecha;
        // fechaCita;
        // estatus;
        // lstAjaxEventos;
        // lstEventos;
        /*
color: "#8d8",
content: 'Earth Day Lunch',
disabled: true,
endDate: new Date(2017, 11, 22, 13),
meeting: true,
reminder: true,
startDate: new Date(2017, 11, 22, 12)
        */

        constructor() {
            
        }
        /* Getters */
        getIdEvento(){
            return this.IdEvento;
        }
        getIdUsr(){
            return this.IdUsr;
        }
        getFechaReserva(){
            return this.FechaReserva;
        }
        getFechaCita(){
            return this.FechaCita;
        }
        getEstatus(){
            return this.Estatus;
        }
        /* Setters */
        setIdEvento(idEvento){
            this.IdEvento = idEvento;
        }
        setIdUsr(idUsr){
            this.IdUsr = idUsr;
        }
        setFechaReserva(fechaReserva){
            this.FechaReserva = fechaReserva;
        }
        setFechaCita(fechaCita){
            this.FechaCita = fechaCita;
        }
        setEstatus(estatus){
            this.Estatus = estatus;
        }

        formatDate(yyyy, mm, d, h){
            return new Date(yyyy, mm, d, h);
        }
        
        callAllEvents(test){
            // return lstAjaxEventos = (test) => {
                return new Promise( (resolve, reject) => {
                    $.ajax({
                        method : 'POST',
                        url : '/citas/citas',
                        dataType : 'json',
                        // data: { 'attr' :'val' },
                        success: function(result){
                            resolve(result);
                        }
                    });    
                });
            // }
        }

        getAllEvents(test) {
            // var lstAjaxEventos = this.callAllEvents(test);
            var lstEventos = [];
            var test = this.callAllEvents(test).then( (success) => {
                // console.log(success);
                $.each(success['data'], function(i, v){
                    var date = v['fechaCita'].split("-");
                    // console.log("dateFECHA:::::::::"); 
                    // console.log(new Date(v['fechaCita'].split("-")[0], v['fechaCita'][1], date[2].split(" ")[0], 1));
                    var obj = "{color     : '#8d8'," +
                                            "content   : " + v['nombreUsuario'] + " - " + v['idCita'] + "," +
                                            "disabled  : true," +
                                            "endDate   : " + new Date(v['fechaCita'].split("-")[0], v['fechaCita'].split("-")  [1], v['fechaCita'].split("-")[2].split(" ")[0], 1)  + "," +
                                            "meeting   : true," +
                                            "reminder  : true," +
                                            "startDate : " + new Date(v['fechaCita'].split("-")[0], v['fechaCita'].split("-")  [1], v['fechaCita'].split("-")[2].split(" ")[0], 1) + "},";
                    var array = JSON.parse(JSON.stringify(obj));

                    lstEventos.push(obj);
                    // console.log("dentro THEN");
                    // console.log(lstEventos);   
                });
                
            });
            // console.log("dentro FUNCTION");
            // console.log(lstEventos);
            return lstEventos;
        }


        getEspecificEvent(idEvent) {
            var untEvent = (idEvent) => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        method : 'POST',
                        url : '/citas/selectcita',
                        dataType : 'json',
                        // data : { 'ind' : idEvent },
                        success: function(result){
                            resolve(result);
                        }
                    });
                });
            }
        }
    }