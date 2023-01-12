export const debounce = (callback, time) => {
    let timeout;

    return (argument) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => callback(argument), time);
    };
};
