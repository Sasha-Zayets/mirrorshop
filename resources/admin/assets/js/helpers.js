export const randomNumber = (min, max) => Math.floor(Math.random() * (max - min) + min);

export const filterNumber = phones => phones.filter(phone => phone.number !== null);