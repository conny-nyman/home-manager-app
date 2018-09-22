import gql from 'graphql-tag'

// Getters

export const GET_MANAGEMENT_GROUPS_QUERY = gql`
    {
      readManagementGroups {
        ID
        Name
        Text
      }
    }
`

export const GET_SLIDES_QUERY = gql`
    {
      readSlides {
        Text
        TextWhite
        Image {
          File {
            URL
          }
        }
      }
    }
`

export const GET_CATEGORIES_QUERY = gql`
    {
      readCategories {
        ID
        Title
      }
    }
`

export const GET_TYPES_QUERY = gql`
    {
      readTypes {
        ID
        Title
      }
    }
`

export const GET_STORES_QUERY = gql`
    {
      readStores {
        ID
        Title
      }
    }
`

// Mutations

export const CREATE_CATEGORY_MUTATION = gql`
  mutation CreateCategoryMutation($title: String) {
    createCategory(Input: {Title: $title}) {
        ID
        Title
      }
    }
`

export const CREATE_TYPE_MUTATION = gql`
  mutation CreateTypeMutation($title: String) {
    createType(Input: {Title: $title}) {
        ID
        Title
      }
    }
`

export const CREATE_STORE_MUTATION = gql`
  mutation CreateStoreMutation($title: String) {
    createStore(Input: {Title: $title}) {
        ID
        Title
      }
    }
`
