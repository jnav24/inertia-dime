export const randomString = (num: number) => {
    return [...Array(num)].map(() => Math.random().toString(36)[2]).join('');
};
