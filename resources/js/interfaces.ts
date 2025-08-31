export interface IProduct {
    barcode: number;
    description: string;
    category: string;
    unit: string;
    supplier: string;
    purchase_price: number;
    sale_price: number;
    validity: Date;
    minimum_stock: number;
    maximum_stock: number;
    available_stock: number;
    location: string;
    is_active: boolean;
}
