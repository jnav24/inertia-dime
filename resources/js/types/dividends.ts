export enum TransactionEnum {
    BUY = 'bought',
    SELL = 'sold',
    REINVEST = 'reinvested',
}

export type Dividend = {
    change: number;
    change_percentage: number;
    declaration_date: string;
    description: string;
    ex_date: string;
    frequency: 'annually' | 'semiannual' | 'quarterly' | 'monthly';
    image: string;
    name: string;
    payout_amount: number;
    payout_date: string;
    price: number;
    record_date: string;
    sector: string;
    symbol: string;
    uuid: string;
    yield: number;
};

type UserDividendData = {
    uuid: string;
    quantity: number;
};

export type UserDividend = UserDividendData & {
    dividend: Dividend;
};

export type UserDividendSearch = Partial<UserDividendData> & { dividend: Dividend };

export type UserDividendTransaction = {
    uuid: string;
    transaction_type: TransactionEnum;
    quantity: number;
    price: number;
    transaction_date: string;
    user_dividend: UserDividend;
}
