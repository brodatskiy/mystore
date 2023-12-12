import { defineStore } from 'pinia'
import axios from 'axios'

interface ProductState {
  isLoading: boolean
  categoryFilter: string
  sortFilter: string
  searchQuery: string
  products: Product[]
}

export interface Product {
  id: number
  title: string
  price: number
  description: string
  category: string
  image: string
  rating: {
    rate: number
    count: number
  }
}

export const useProductStore = defineStore('ProductStore', {
  state: (): ProductState => {
    return {
      isLoading: false,
      categoryFilter: 'All',
      sortFilter: 'Featured',
      searchQuery: '',
      products: []
    }
  },

  getters: {
    filteredProducts(state): Product[] {
      return state.categoryFilter == 'All'
        ? state.products
        : state.products.filter((product) => {
            return product.category == state.categoryFilter
          })
    },

    filtredAndSearchProducts(state): Product[] {
      return this.filteredProducts.filter((product) => {
        return product.title.toLowerCase().includes(state.searchQuery.toLowerCase())
      })
    },

    filtredAndSearchAndSortProducts(state): Product[] {
      switch (state.sortFilter) {
        case 'Featured':
          return this.filtredAndSearchProducts.sort((prev, next) => {
            return next.rating.rate - prev.rating.rate
          })
          break

        case 'Price: High-Low':
          return this.filtredAndSearchProducts.sort((prev, next) => {
            return next.price - prev.price
          })
          break

        case 'Price: Low-High':
          return this.filtredAndSearchProducts.sort((prev, next) => {
            return prev.price - next.price
          })
          break
        default:
          return this.filtredAndSearchProducts
          break
      }
    }
  },
  actions: {
    async fetchProducts() {
      try {
        this.isLoading = true
        const response = await axios.get('https://fakestoreapi.com/products')
        this.products = response.data
      } catch (error) {
        console.log(error)
      } finally {
        this.isLoading = false
      }
    },
    addProduct(product: Product) {
      this.products.push(product)
    }
  }
})
