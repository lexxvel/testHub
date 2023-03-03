import moment from "moment";

export function findArrayElementById(array, id, element) {
    id = Number(id);
    let x;
    if (element === 'steps') {
        x = array.find(x => x.version === id);
    } else {
        x = array.find(x => x.id === id);
    }

    switch (element) {
        case 'role':
            return x.role;
        case 'type':
            return x.type;
        case 'status':
            return x.status;
        case 'priority':
            return x.priority;
        case 'project':
            return x.project;
        case 'link':
            return x.link;
        case 'steps':
            return x.steps;
        default:
            return null;
    }
}

export function helloBlyat() {
    alert("Привет, мир")
}

export function formatDateToRussian(value){
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY')
    } else {
        return null;
    }
}
