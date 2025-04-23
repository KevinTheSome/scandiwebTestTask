export type ProductType = {
  product_id: string;
  name: string;
  inStock: boolean;
  gallery: gallery[];
  description: string;
  category: string;
  attributes: string;
  prices: Price[];
  brand: string;
  __typename: string;
};

type Price = {
  amount: number;
  currency: {
    symbol: string;
  };
};
type gallery = {
  image_url: string;
};
