module.exports = function flat(array) {
    let result = [];
    array.forEach((a) => {
        result.push(a);
        if (Array.isArray(a.children)) {
            result = result.concat(flat(a.children));
        }
    });
    return result;
};
