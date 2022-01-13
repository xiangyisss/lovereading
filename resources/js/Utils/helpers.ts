interface File {
    key: string
    value: any
}

const constructFormData = (data, file?: File) => {
    let constructedData = new FormData();
    for (let key in data){
        constructedData.append(key, data[key]);
    }
    file && constructedData.append(file.key, file.value)
    return constructedData;
}

export {
    constructFormData
}