import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContractListItem from '../../src/components/ContractListItem'


describe('ContractListItem.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContractListItem /></Provider>)
  })
})