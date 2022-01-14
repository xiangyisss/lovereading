interface File {
    key: string
    value: any
}

const constructFormData = (data: any, files?: File[]) => {
    let constructedData = new FormData();
    for (let key in data){
        constructedData.append(key, data[key]);
    }
    files && files.length > 0 && files.map((file: File) => {
        constructedData.append(file.key, file.value)
    })
    return constructedData;
}

export {
    constructFormData
}