export function getUser(){
    const userStr = localStorage.getItem("user");

    if (!userStr){
        return null;
    }
    return JSON.parse(userStr);

}

export function hasRole(roles,role){

        for (var i=0;i<roles.length;i++){


            if (role==roles[i]){
                console.log('here');
                return true;
            }
        }

        return false;

}